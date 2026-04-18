<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Move questions page.
 *
 * @package    qbank_bulkxmlexport
 * @copyright  2024 Stephan Robotta
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../../config.php');
require_once(__DIR__ . '/../../editlib.php');
require_once($CFG->libdir . '/questionlib.php');
require_once($CFG->dirroot . '/question/format/xml/format.php');

use qbank_bulkxmlexport\xmlexport;

global $DB, $COURSE;

$selected = optional_param(xmlexport::KEY, false, PARAM_BOOL);
$cmid = optional_param('cmid', 0, PARAM_INT);
$courseid = optional_param('courseid', 0, PARAM_INT);
$category = optional_param('category', null, PARAM_SEQUENCE);

\core_question\local\bank\helper::require_plugin_enabled('qbank_bulkxmlexport');

if ($cmid) {
    [$module, $cm] = get_module_from_cmid($cmid);
    require_login($cm->course, false, $cm);
    $thiscontext = context_module::instance($cmid);
} else if ($courseid) {
    require_login($courseid, false);
    $thiscontext = context_course::instance($courseid);
} else {
    throw new moodle_exception('missingcourseorcmid', 'question');
}

$contexts = new core_question\local\bank\question_edit_contexts($thiscontext);

$questionlist = [];

// The checked checkboxes have a name like q<ID> where <ID> is the question id.
$request = data_submitted();
if ($request) {
    foreach (array_keys(get_object_vars($request)) as $key) {
        if (strpos($key, 'q') === 0) {
            $questionid = substr($key, 1);
            if (is_number($questionid)) {
                $question = question_bank::load_question_data($questionid);
                $questiondata = question_bank::load_question_data($questionid);
                question_require_capability_on($questiondata, 'view');
                $questionlist[] = $questiondata;
            }
        }
    }
}

$PAGE->set_url(xmlexport::URL);
$PAGE->set_heading($COURSE->fullname);
$PAGE->set_pagelayout('admin');

// Set up the Moodle xml export format.
$qformat = new qformat_xml();
$filename = question_default_export_filename($COURSE, (object)['name' => 'xmlexport']);
$filename = substr($filename, 0, strrpos($filename, '-')); // Remove the question id from the name.
$filename .= $qformat->export_file_extension();
$qformat->setContexts($contexts->having_one_edit_tab_cap('export'));
$qformat->setCourse($COURSE);
$qformat->setQuestions($questionlist);
$qformat->setCattofile(false);
$qformat->setContexttofile(false);

// Do the export and send the file to the browser.
if (!$qformat->exportpreprocess()) {
    send_file_not_found();
}
if (!$content = $qformat->exportprocess(true)) {
    send_file_not_found();
}
send_file($content, $filename, 0, 0, true, true, $qformat->mime_type());

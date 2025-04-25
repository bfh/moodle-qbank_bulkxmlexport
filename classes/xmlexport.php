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

namespace qbank_bulkxmlexport;
use core_question\local\bank\bulk_action_base;
/**
 * Class bulk_move_action is the base class for moving questions.
 *
 * @package    qbank_bulkxmlexport
 * @copyright  2024 Stephan Robotta
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class xmlexport extends bulk_action_base {

    /**
     * The key for the action.
     */
    public const KEY = 'bulkxmlexport';

    /**
     * The URL for the action.
     */
    public const URL = '/question/bank/bulkxmlexport/export.php';

    /**
     * Return the string to show in the list.
     *
     * @return string
     * @throws \coding_exception
     */
    public function get_bulk_action_title(): string {
        return get_string('exportasxml', 'question');
    }

    /**
     * Return the key for the action.
     *
     * @return string
     */
    public function get_key(): string {
        return self::KEY;
    }

    /**
     * Return the URL of the bulk action redirect page.
     *
     * @return \moodle_url
     */
    public function get_bulk_action_url(): \moodle_url {
        return new \moodle_url(self::URL);
    }

    /**
     * Get the capabilities for the bulk action.
     *
     * @return string[]|null
     */
    public function get_bulk_action_capabilities(): ?array {
        return [
            'moodle/question:viewall',
        ];
    }
}

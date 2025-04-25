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
use core_question\local\bank\plugin_features_base;
use core_question\local\bank\view;

/**
 * Class plugin_feature is the entrypoint for the features.
 *
 * @package    qbank_bulkxmlexport
 * @copyright  2024 Stephan Robotta
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class plugin_feature extends plugin_features_base {

    /**
     * This method will return the array objects for the bulk actions ui.
     *
     * @param view $view
     * @return bulk_action_base[]
     */
    public function get_bulk_actions(view $view): array {
        return [
            new xmlexport($view),
        ];
    }
}

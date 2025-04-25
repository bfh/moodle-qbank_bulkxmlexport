@qbank @qbank_bulkxmlexport @javascript
Feature: Use the plugin to export several question at once in the qbank manager.

  Background:
    Given the following "users" exist:
      | username | firstname | lastname | email                |
      | teacher1 | Teacher   | 1        | teacher1@example.com |
    And the following "courses" exist:
      | fullname | shortname | category |
      | Course 1 | C1        | 0        |
    And the following "course enrolments" exist:
      | user     | course | role           |
      | teacher1 | C1     | editingteacher |
    And the following "activities" exist:
      | activity | name      | course | idnumber |
      | qbank    | Qbank 1   | C1     | qbank1   |
    And the following "question categories" exist:
      | contextlevel    | reference | questioncategory | name           |
      | Activity module | qbank1    | Top              | top            |
      | Activity module | qbank1    | top              | Default for C1 |
      | Activity module | qbank1    | Default for C1   | Subcategory    |
    And the following "questions" exist:
      | questioncategory | qtype     | name           | questiontext                  |
      | Default for C1   | truefalse | First question | Answer the first question     |
      | Subcategory      | essay     | Essay Foo Bar  | Write about whatever you want |

  Scenario: Enable/disable bulk export xml questions bulk action from the base view
    Given I log in as "admin"
    When I navigate to "Plugins > Question bank plugins > Manage question bank plugins" in site administration
    And I should see "Bulk move questions"
    And I click on "Disable" "link" in the "Bulk XML Export questions" "table_row"
    And I am on the "C1" "Course" page
    And I navigate to "Question banks" in current page administration
    And I click on "Qbank 1" "link"
    And I click on "input[type='checkbox']" "css_element" in the "First question" "table_row"
    And I click on "With selected" "button"
    Then I should not see question bulk action "bulkxmlexport"
    And I navigate to "Plugins > Question bank plugins > Manage question bank plugins" in site administration
    And I click on "Enable" "link" in the "Bulk XML Export questions" "table_row"
    And I am on the "C1" "Course" page
    And I navigate to "Question banks" in current page administration
    And I click on "Qbank 1" "link"
    And I click on "input[type='checkbox']" "css_element" in the "First question" "table_row"
    And I click on "With selected" "button"
    Then I should see question bulk action "bulkxmlexport"

  Scenario: Bulk export questions as Moodle XML
    Given I log in as "teacher1"
    And I am on the "C1" "Course" page logged in as "teacher1"
    And I navigate to "Question banks" in current page administration
    And I click on "Qbank 1" "link"
    And I should see "First question"
    And I should not see "Essay Foo Bar"
    And I click on "Also show questions from subcategories" "checkbox"
    And I click on "Apply filters" "button"
    And I should see "First question"
    And I should see "Essay Foo Bar"
    And I click on "First question" "checkbox"
    And I click on "Essay Foo Bar" "checkbox"
    And I click on "With selected" "button"
    And I should see question bulk action "bulkxmlexport"
    And I click on question bulk action "bulkxmlexport"
    #A dialogue appears to download the file which must be confirmed with ok. Therefore the next step does not work.
    #Then following "Download" should download between "1" and "180000" bytes

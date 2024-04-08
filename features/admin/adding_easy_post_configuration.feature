@managing_easy_post_configurations
Feature: Adding a new Easy Post configuration
    In order to show different configurations
    As an Administrator
    I want to add a new Easy Post configuration to the admin

    Background:
        Given I am logged in as an administrator
        And the store operates on a single channel in "United States"

    @ui
    Scenario: Adding a new Easy Post configuration
        Given I want to add a new Easy Post configuration
        When I fill the code with "default"
        And I fill the api key with "123456"
        And I add it
        Then I should be notified that it has been successfully created
        And the Easy Post configuration "default" should appear in the admin

    @ui
    Scenario: Trying to add a new Easy Post configuration with empty fields
        Given I want to add a new Easy Post configuration
        When I fill the code with "default"
        And I add it
        Then I should be notified that the form contains invalid fields

    @ui
    Scenario: Trying to add an Easy Post configuration with existing code
        Given there is an existing Easy Post configuration with "default" code
        And I want to add a new Easy Post configuration
        When I fill the code with "default"
        And I add it
        Then I should be notified that there is already an existing Easy Post configuration with provided code

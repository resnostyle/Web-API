Feature: Membership

  In order to give registered members access to restricted content
  As an administrator
  I need authentication and registration for users

  @mail
  Scenario: Registration
    When I register "johndoe" "JohnDoe@example.com"
    Then I should have an account
    And An email should have been sent

  @mail
  Scenario: Successful Authentication
    Given I have an account "johndoe" "JohnDoe@example.com"
    When I login
    Then I should be logged in

  Scenario: Failed Authentication
    When I login with invalid credentials
    Then I should not be logged in
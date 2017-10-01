Feature: Invites

  In order to bring new users into the site
  An authenticated user
  I need users to be able to invite new users

  Scenario: Successfully Sending an Invite
    Given I have an account "johndoe" "johndoe@example.com"
    And I login
    When I send an invite to "janedoe@example.com"
    Then They receive the invite

  Scenario: Failed Sending an Invite
    When I send an invite to "janedoe@example.com" without an account
    Then They should not receive the invite

  Scenario: Successfully Redeeming an Invite
    Given I have an invite
    When I redeem the invite
    Then I should be able to register

  Scenario: Failed Redeeming an Invite
    When I redeem an invalid invite
    Then I should not be able to register

  Scenario: Using Free Invites
    Given There are free invites available
    When I check for free invites
    And I use a free invite
    Then I should be able to register
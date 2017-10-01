Feature: Users Profile

 To allow users to view and modify their profiles
 Authenticated Users
 I need users to be able to modify their information and see billing data

 Scenario: View Profile
  Given I have an account "john doe" "johndoe@example.com"
  And I login
  When I view my profile
  Then I should see my user information

 Scenario: Edit Profile
  Given I have an account "john doe" "johndoe@example.com"
  And I login
  When I update my password to "secret2"
  Then My password should be updated
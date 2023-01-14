Feature: Create a new user
  In order to have users on the platform
  As a user with admin permissions
  I want to create a new user

  Scenario: A valid non existing user
    Given I send a PUT request to "/users/1aab45ba-3c7a-4344-8936-78466eca77fa" with body:
    """
    {
      "name": "John Smith",
      "email": "john-smith@gamil.com",
      "password": "**-Pa55w0rD-**"
    }
    """
    Then the response status code should be 201
    And the response should be empty

  Scenario: An invalid id
    Given I send a PUT request to "/users/abc" with body:
    """
    {
      "name": "John Smith",
      "email": "john-smith@gamil.com",
      "password": "**-Pa55w0rD-**"
    }
    """
    Then the response status code should be 400
    And the response content should be:
    """
    <CodelyTv\Mooc\Users\Domain\UserId> does not allow the value <abc>.
    """

  Scenario: A reapeated user
    Given I send twice a PUT request to "/users/00000000-0000-0000-0000-000000000000" with body:
    """
    {
      "name": "Test",
      "email": "test@test.com",
      "password": "**-Pa55w0rD-**"
    }
    """
    Then the response status code should be 400
    And the response content should be:
    """
    The user is already recorded in the database
    """
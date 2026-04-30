
# PHP Chess
> Originally written as a take-home assignment.

## Requirements
- PHP 8.4
- Composer

## Running the Application
To run the application, follow these steps:
1. Install dependencies:
   ```bash
   composer install
   ```
2. Run the application:
   ```bash
   php app.php
   ```

## Running the Tests
To run the tests, run this command:
   ```bash
   ./vendor/bin/phpunit tests
   ```

## Notes
This is a simple CLI PHP application that demonstrates basic logic for moving chess pieces on a board. The app includes:
- **Board Management**: Place and move pieces.
- **Piece Movement Validation**: Validates if pieces move according to their respective rules (e.g., bishop moves diagonally).
- **Testing**: Includes PHPUnit tests for the board and pieces, including movement and rules validation.

# Changelog

Todos os principais eventos e alterações neste projeto.

## [v0.1.20] - 2025-08-04

- 2f941ef feat: Add cancellationPayment method to handle payment cancellations in PaymentGateway and CardService

## [v0.1.19] - 2025-06-25

- 8a7ccaa refactor: Update PaymentException to extend Exception and improve error handling; enhance logging in CardService

## [v0.1.18] - 2025-06-24

- f863f5f feat: Add capturePayment method and enhance transaction description generation in CardService

## [v0.1.17] - 2025-06-20

- 644b3f6 feat: Update Logger class to use a log file pattern with date formatting for improved log management

## [v0.1.16] - 2025-06-20

- 2d6a8b0 style: Improve code formatting and add missing newlines in PaymentException and BlikService

## [v0.1.15] - 2025-06-20

- 3a37802 feat: Update payment methods to include customer parameter for improved processing

## [v0.1.14] - 2025-06-20

- b1c1dee feat: Enhance PaymentGateway with detailed method documentation and improve logging
- c3495ce feat: Refactor PaymentException to extend PrestaShopException and improve error handling
- 29b3350 feat: Add refundPayment method to PaymentMethodInterface with detailed documentation
- c940732 feat: Add detailed method documentation and improve code structure in BlikService
- 8c0984d feat: Add detailed method documentation and improve code structure in CardService
- 8ab463e feat: Enhance MbWayService with detailed method documentation and improve code structure
- 284d663 feat: Enhance MultibancoService with detailed method documentation and improve code structure
- 1205df8 feat: Add detailed method documentation and improve structure in PayByLinkService
- 3f99e02 feat: Enhance XPayService with detailed method documentation and improve API endpoint handling

## [v0.1.13] - 2025-06-17

- 4ff83cc feat: Add logging and improve refundPayment and getPaymentStatus methods in PaymentGateway and CardService
- 82bc6f5 feat: Enhance refundPayment method to include additional customer information and improve request handling

## [v0.1.12] - 2025-06-16

- 7bcd0fc feat: Add refundPayment method to PaymentGateway with logging and validation

## [v0.1.11] - 2025-06-05

- 2acf2f0 fix: Update CHANGELOG to reflect recent Logger class improvements

## [v0.1.10] - 2025-06-05

- 9ad420c fix: Refactor Logger class to improve log file path handling and formatting

## [v0.1.9] - 2025-06-05

- 6af615b fix: Update Logger class to allow optional log file path and use ISO 8601 timestamp format

## [v0.1.8] - 2025-05-28

- 5087b08 clean
- 780e5de fixed code
- 6a5fc94 fix services

## [v0.1.7] - 2025-05-26

- c7dd9e3 fix: Update generate-changelog script to include tags in the output and improve comments

## [v0.1.6] - 2025-05-26

- 2a0e145 fix: Update release workflow to enhance permissions and ensure GITHUB_TOKEN is set for tag creation
- fa942cc fix: Refactor release script to improve file system access for changelog
- 87d460c feat: Update release workflow to automatically bump version tags and create GitHub releases
- 529a228 fix: Update PaymentGateway to validate payment data and include bearer token and client ID in payment request
- 3116715 fix: Update Logger class to set correct log file path and ensure log directory creation
- 298d049 fix: Correct log file path and ensure log directory creation in Logger class

## [v0.1.5] - 2025-05-19

- 4ac7404 feat: Enhance getPaymentStatus method to include bearer token and client ID validation
- c7c23bd Merge branch 'main' of https://github.com/michelmelo/payments-gateway
- c72a89a refactor: Update log file path and comment out debug print statements in payment services

## [v0.1.4] - 2025-05-09

- cd5e70e fix: Update PHP version requirement and add composer.lock to .gitignore

## [v0.1.3] - 2025-05-09

- 5c6ebb9 Implement code changes to enhance functionality and improve performance
- afb9350 chore: Update dependencies and adjust PHP version requirement in composer.lock

## [v0.1.2] - 2025-05-09

- 4fedbdf fix: Update PHP version requirement and add release script to composer.json
- 81758d0 docs: Update CHANGELOG with initial SDK implementation and recent changes

## [v0.1.1] - 2025-05-09

- 8805717 feat: Add GitHub Actions workflow for release automation and update license in composer.json

## [0.1.0] - 2025-04-21

- afb90aa feat: Add Debug Helper and Enhance Payment Services
- 9a2afbc Refactor BlikService and PaymentWidget for improved variable naming and logging
- f8b522f Refactor processPayment method in BlikService to enhance payment request structure and error handling
- d38b1dd Fix namespace declaration in PaymentException for correct namespacing
- fc32488 Refactor processPayment method in PaymentGateway to improve service handling and validation
- 0dd3762 Refactor PayByLinkService methods for clarity and consistency in payment processing
- 7e13caf Refactor BlikService payment processing and status retrieval methods for improved clarity and functionality
- 7100527 Add return type declarations for processPayment and getPaymentStatus methods in XPayService
- 8a58dbd Implement validatePayment method in CardService for payment data validation
- aecc27e Refactor MultibancoService methods for clarity and consistency in payment processing
- 4528d39 Change validatePayment method return type to bool and add return statement
- d10e7ec Refactor MbWayService payment processing implementation and improve code clarity
- a174901 Add manual test script for payment processing using PaymentGateway and PaymentWidget
- 74ca6e4 Add logging functionality to PaymentGateway and BlikService for better traceability
- 569ab10 Add PaymentWidget class for generating payment scripts and forms in the SDK
- 6dfb145 Add script to generate changelog from Git commits
- bb4f373 Refactor code style and organization across payment services and tests for consistency
- 5462e87 Implement Blik payment processing, refund, and status retrieval methods
- 14b9e40 fixed
- 2cd99d7 Refactor CardService and MbWayService to implement payment processing and status retrieval methods
- 09ab442 Refactor test namespaces and update payment gateway tests
- 49fbceb Add Payment Gateway SDK with initial implementation
- 6cb63bb Initial commit


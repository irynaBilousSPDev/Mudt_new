# Security policy — MUDT WordPress Theme

## Supported versions

Only the theme version deployed on **production** (`main` / uni-munich.de) is
actively maintained.

## Reporting a vulnerability

Do **not** open a public issue for security problems.

Contact the project maintainers / SPDev team privately with:

- Affected URL or template (if known)
- Steps to reproduce
- Impact assessment (auth bypass, XSS, data exposure, etc.)

## Secrets

- Never commit `deploy.local.env` or production credentials
- Rotate FTP/SFTP passwords if they may have leaked
- Prefer `DEPLOY_*` flags only on trusted machines

## Scope

This policy covers the **theme codebase** in this repository. Hosting, WordPress
core, plugins (ACF, CF7, etc.), and server config are outside this repo — report
those through the usual hosting / WP admin channels.

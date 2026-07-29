**One-time** helper — clone production database to a local/staging WordPress DB.

Uses values from local `deploy.local.env` only (`DB_*`, `DEV_SITE_URL`, `PROD_SITE_URL`). Do not put staging hostnames in theme docs.

```bash
npm run import:db:dev
```

Then (if needed) sync uploads / deploy theme with your usual local workflow.

Never commit `deploy.local.env` or SQL dumps with secrets.

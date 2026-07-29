Deploy the **Mudt_new** theme to **production** via FTPS (`deploy.local.env` / `SFTP_PROD_*`).

```bash
npm run deploy:prod
```

Full sync / large updates (batched FTPS):

```bash
DEPLOY_FULL=true npm run deploy:prod
```

Optional: `DEPLOY_BATCH_SIZE`, `DEPLOY_BATCH_PAUSE_MS` in `deploy.local.env`.

Never commit `deploy.local.env`. Git metadata (`.git*`) is not uploaded.

Deploy the **Mudt_new** theme to the **staging** target via FTP/SFTP (`deploy.local.env`).

```bash
npm run deploy:dev
```

Full sync when needed:

```bash
DEPLOY_FULL=true DEPLOY_ALLOW_DIRTY=true npm run deploy:dev
```

Never commit `deploy.local.env`. Git metadata (`.git*`) is not uploaded.

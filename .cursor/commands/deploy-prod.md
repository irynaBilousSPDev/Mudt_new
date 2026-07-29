Deploy the **Mudt_new** theme to **production** — merge **`dev` → `main`**, push, then FTPS via `deploy.local.env` (`SFTP_PROD_*`).

| Branch | Use |
|--------|-----|
| `dev` | Day-to-day work |
| `main` | Production |

Prefer this flow over ad-hoc prod uploads.

```bash
git checkout main
git merge dev
git push origin main
npm run deploy:prod
```

First full sync: `DEPLOY_FULL=true npm run deploy:prod`

Never commit `deploy.local.env`.

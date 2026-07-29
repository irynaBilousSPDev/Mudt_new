Deploy the **Mudt_new** theme to the **staging** target — branch **`dev`**: commit → **push GitHub** → FTP/SFTP via `deploy.local.env`.

Do not document staging hostnames in repo docs. Config stays in local `deploy.local.env` only.

```mermaid
flowchart LR
  A[dev branch] --> B[commit if needed]
  B --> C[git push]
  C --> D[npm run deploy:dev]
```

```bash
git checkout dev
npm run deploy:dev
```

Uploads **git-changed files** by default. Full sync when needed:

```bash
DEPLOY_FULL=true DEPLOY_ALLOW_DIRTY=true npm run deploy:dev
```

Never commit `deploy.local.env`.

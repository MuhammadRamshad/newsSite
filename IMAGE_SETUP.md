# Local Image Setup

All news article images are now served from:

    public/assets/images/uploads/

## What to do

1. Copy your news images into `public/assets/images/uploads/`.
2. The filenames in this folder must match the `photo` column in the `tbl_news` database table.
3. Author images go in `public/assets/images/authors/`.
4. Category banners go in `public/assets/images/categories/`.

## Example

If the database has `photo = 'my-article-hero.webp'`, the file must be at:

    public/assets/images/uploads/my-article-hero.webp

No code changes are needed — the `asset()` helper will serve the file correctly.

## Fallback

If a photo value is missing or empty, the model falls back to `assets/images/foxiz.webp`.

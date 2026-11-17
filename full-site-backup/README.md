# Complete Green Pack backup

This snapshot includes all website files and the full WordPress database from 17 November 2026. The files include WordPress core, themes, plugins, uploads, configuration, and existing server archives.

The archives use AES-256-GCM encryption because this repository is public. The decryption key is kept separately by the site owner.

Download the archive files using Git LFS, install Python and the cryptography package, then run the restore script with the path to the key file and an empty output directory.

    git lfs pull
    python -m pip install cryptography
    python full-site-backup/restore.py /path/to/DECRYPTION-KEY.txt /path/to/output

The script produces website.tar.gz and database.sql.gz. Compare their SHA-256 checksums with manifest.json. Extract the website archive into a hosting directory and import the SQL database into MySQL. Configure the database connection and site URL for the target host. A complete WordPress restore requires both archives and the key.

Archive encryption and decryption have been verified. A live restore has not been tested.

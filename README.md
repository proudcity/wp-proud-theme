# wp-proud-theme

The ProudCity Wordpress theme built on top of [Bootstrap](http://getbootstrap.com) and [Sage](https://roots.io/sage/). [ProudCity](http://proudcity.com) is a Wordpress platform for modern, standards-compliant municipal websites.

All bug reports, feature requests and other issues should be added to the [wp-proudcity Issue Queue](https://github.com/proudcity/wp-proudcity/issues).

### Building notes

You should install [Node Version Manager](https://github.com/nvm-sh/nvm) to run
the commands below and work on Node v18+ for this build.

If you're using the [Nix Package](https://nixos.org/) manager there is a `shell.nix` file that will install all the requirements above in your shell by running `nix-shell`. It **will not** install NVM as you don't need it with Nix. The advantage of Nix is that it install nothing globally so you don't have version conflicts. The current shell you're using is the only one that has Node 18.

## Setup Build Process

If you're using `nix` and `direnv` you may need to create the `.envrc` file or type `direnv allow` when you first `cd` into the folder so everything installs.

```
nvm use 18 (skip if you're using nix)
# clones our proudcity-patterns repository and sets it up as the theme expects
npm run projectsetup
# build project
npm run build
# watch and rebuild as changes happen
npm run dev
```

To update ProudCity Patterns run the following NPM command to delete the old repository and download the latest master branch.

```
npm run projectupdate
```

## Build Output

The build process generates the following files in the `dist/` directory:

- **CSS:** `dist/styles/` - proud.css, proud-vendor.css, editor.css, ie9-and-below.css
- **JS:** `dist/scripts/` - main.min.js, customizer.min.js, modernizr.min.js, bootstrap.min.js
- **Fonts:** `dist/fonts/` - govicons, public-sans, red-hat-display

<https://github.com/proudcity/proudcity-patterns>

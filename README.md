# wp-proud-theme
The ProudCity Wordpress theme built on top of [Bootstrap](http://getbootstrap.com) and [Sage](https://roots.io/sage/). [ProudCity](http://proudcity.com) is a Wordpress platform for modern, standards-compliant municipal websites.

All bug reports, feature requests and other issues should be added to the [wp-proudcity Issue Queue](https://github.com/proudcity/wp-proudcity/issues).


### Building notes
You should install [Node Version Manager](https://github.com/nvm-sh/nvm) to run
the commands below and work on Node v18 for this build.

You should also intall [bower](https://bower.io/).

If you're using the [Nix Package](https://nixos.org/) manager there is a `shell.nix` file that will install all the requirements above in your shell by running `nix-shell`. It **will not** install NVM as you don't need it with Nix. The advantage of Nix is that it install nothing globally so you don't have version conflicts. The current shell you're using is the only one that has Node 18 or Bower.

## Setup Build Process

```
nvm use 18 (skip if you're using nix)
# clones our proudcity-patterns repository and sets it up as the theme expects
npm run-script projectsetup
# build project
npx mix
# watch and rebuild as changes happen
npx mix watch
```

To update ProudCity Patterns run the following NPM command to delete the old repository and download the latest master branch.

```
npm run-script projectupdate
```

**Deprecated Commands from Gulp**
```
# Pull on both the theme and proudcity-patterns repos
gulp pull
# Watch for changes in both the theme and proudcity-pattern repos
# (@TODO the livebrowser task is out of date and no longer functions)
gulp watch
# Commit an updated to both the theme and proudcity-patterns repos
gulp commit
# Push both the theme and proudcity-patterns repos
gulp push
```
https://github.com/proudcity/proudcity-patterns

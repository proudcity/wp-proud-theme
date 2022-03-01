# wp-proud-theme
The ProudCity Wordpress theme built on top of [Bootstrap](http://getbootstrap.com) and [Sage](https://roots.io/sage/). [ProudCity](http://proudcity.com) is a Wordpress platform for modern, standards-compliant municipal websites.

All bug reports, feature requests and other issues should be added to the [wp-proudcity Issue Queue](https://github.com/proudcity/wp-proudcity/issues).


Building notes
```
nvm use 8
npm install
bower install
gulp
```

## Working with ProudCity Patterns
```
nvm use 8
npm install
bower install
# Replace patterns with the git version
cd bower_components
rm -r proudcity-patterns
git clone git@github.com:proudcity/proudcity-patterns.git
# Use the gulp commands to simplify development
cd ../
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

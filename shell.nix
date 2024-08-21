let
	nixpkgs = fetchTarball "https://github.com/NixOS/nixpkgs/tarball/nixos-24.05";
	pkgs = import nixpkgs { config = {}; overlays = []; };
in

pkgs.mkShellNoCC {
	packages = with pkgs; [
    nodePackages_latest.bower
    nodePackages_latest.npm
    nodejs_18
];
}

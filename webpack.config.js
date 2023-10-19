const path = require("path");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");

module.exports = {
  entry: [
    path.resolve(__dirname, "plugins/custom/assets/src/js/widget-script-1.js"),
    path.resolve(__dirname, "plugins/custom/assets/src/js/widget-script-4.js"),
  ],
  output: {
    path: path.resolve(__dirname, "plugins/custom/assets"),
    filename: "build/js/[name].min.js",
  },
  plugins: [
    new MiniCssExtractPlugin({
      filename: "build/css/[name].min.css",
    }),
  ],
  module: {
    rules: [
      {
        test: /\.js$/,
        use: "babel-loader",
        exclude: [/node_modules/],
      },
      {
        test: /\.css$/i,
        use: [MiniCssExtractPlugin.loader, "css-loader"],
      },
    ],
  },
  optimization: {
    minimizer: [new CssMinimizerPlugin()],
  },
};

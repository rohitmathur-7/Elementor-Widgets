const path = require("path");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");

module.exports = {
  entry: {
    widget1: "./src/js/widget-script-1.js",
    widget4: "./src/js/widget-script-4.js",
    accordion1: "./src/js/accordion1.js",
    testimonial: "./src/js/testimonial.js",
  },
  output: {
    filename: "[name].min.js",
    path: __dirname + "/build/js",
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
  mode: "production",
};

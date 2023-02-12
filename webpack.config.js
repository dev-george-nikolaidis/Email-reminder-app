const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

module.exports = {
    mode: "development",
    entry: "./app/resources/app.js",
    output: {
        path: path.join(__dirname, "/public/assets/dist"),
        filename: "app.js",
      },
    plugins:[new MiniCssExtractPlugin()],
    module: {
        rules:[
            {
                test:/\.(s[ac]|c)ss$/i,
                use:[ MiniCssExtractPlugin.loader,"css-loader","sass-loader","postcss-loader" ],
            }
        ],
    },
//    devtool:"source-map",
}
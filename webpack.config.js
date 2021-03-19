const path = require('path');
const webpack = require('webpack'); //to access built-in plugins

const {
    VueLoaderPlugin
} = require('vue-loader')
module.exports = {
    entry: './src/index.js',
    output: {
        filename: 'main.js',
        filename: 'bundle.js',
        path: path.resolve(__dirname, 'dist'),
        publicPath: 'public/js',
        productionSourceMap: false,
    },
    resolve: {
        alias: {
            '@': resolve('resources'),
            modules: [path.resolve(__dirname, 'src'), 'node_modules'],
        }
    },
    module: {
        rules: [{
                test: /\.s[ac]ss$/i,
                use: [
                    "style-loader",
                    "css-loader",
                    'vue-style-loader', {
                        loader: "sass-loader",
                        options: {
                            // Prefer `dart-sass`
                            modules: true,
                            localIdentName: '[local]_[hash:base64:8]',

                            //implementation: require("sass"),
                        },

                    },
                ],
            }, {
                test: /\.vue$/,
                loader: 'vue-loader'
            },
            // this will apply to both plain `.js` files
            // AND `<script>` blocks in `.vue` files
            {
                test: /\.js$/,
                loader: 'babel-loader'
            },

        ],
        plugins: [
            // make sure to include the plugin!
            new VueLoaderPlugin()
        ]
    }
};
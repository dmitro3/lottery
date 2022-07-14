const path = require("path");
module.exports = {
    mode: "development",
    entry: { plinko: "./src/plinko.ts" },
    devtool: false,
    module: {
        rules: [
            {
                test: /\.tsx?$/,
                use: "ts-loader",
                exclude: /node_modules/,
            },
        ],
    },
    resolve: {
        extensions: [".tsx", ".ts", ".js"],
    },
    output: {
        filename: "[name].js",
        path: path.resolve(__dirname, "../public/theme/frontend/game/ts"),
    },
    optimization: {
        splitChunks: {
            chunks: "all",
        },
    },
};

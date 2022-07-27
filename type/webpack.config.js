const path = require("path");
module.exports = {
    mode: "development",
    entry: {
        plinko: "./src/plinkov2.ts",
        lotto: "./src/lotto.ts",
        lottomb: "./src/lottomb.ts",
    },
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
        library: "[name]",
        libraryTarget: "var",
    },
    optimization: {
        splitChunks: {
            chunks: "all",
        },
    },
};

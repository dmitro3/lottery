const path = require("path");
module.exports = {
    mode: "production",
    entry: {
        plinko: "./src/plinkov2.ts",
        lotto: "./src/lotto.ts",
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
    },
    optimization: {
        splitChunks: {
            chunks: "all",
        },
    },
};

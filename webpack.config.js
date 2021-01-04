const path = require('path');
const PurgeIconsPlugin = require('purge-icons-webpack-plugin').default;

module.exports = {
    resolve: {
        alias: {
            '@': path.resolve('resources/js'),
        },
    },
    plugins: [
        new PurgeIconsPlugin()
    ]
};

module.exports = {
    devServer: {
        proxy: {
            '/fertilizers/rest': {
                target: 'http://localhost',
                changeOrigin: true,
            },
            '/fertilizers/templates/images': {
                target: 'http://localhost',
                changeOrigin: true
            }
        }
    },
}
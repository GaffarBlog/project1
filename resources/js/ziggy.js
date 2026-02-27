const Ziggy = {
    url: "http:\/\/localhost:8000",
    port: 8000,
    defaults: {},
    routes: {
        "admin.login.index": {
            uri: "admin-area\/login",
            methods: ["GET", "HEAD"],
        },
        "admin.login.post": { uri: "admin-area\/login", methods: ["POST"] },
        "admin.logout.index": {
            uri: "admin-area\/logout",
            methods: ["GET", "HEAD"],
        },
        "admin.dashboard.view": { uri: "admin-area", methods: ["GET", "HEAD"] },
        "admin.profile.view": {
            uri: "admin-area\/profile",
            methods: ["GET", "HEAD"],
        },
        "admin.profile.update": {
            uri: "admin-area\/profile",
            methods: ["POST"],
        },
        "admin.user-role.view": {
            uri: "admin-area\/user-role",
            methods: ["GET", "HEAD"],
        },
        "admin.user-role.create": {
            uri: "admin-area\/user-role",
            methods: ["POST"],
        },
        "admin.user-role.edit": {
            uri: "admin-area\/user-role-edit\/{id}",
            methods: ["GET", "HEAD"],
            parameters: ["id"],
        },
        "storage.local": {
            uri: "storage\/{path}",
            methods: ["GET", "HEAD"],
            wheres: { path: ".*" },
            parameters: ["path"],
        },
    },
};
if (typeof window !== "undefined" && typeof window.Ziggy !== "undefined") {
    Object.assign(Ziggy.routes, window.Ziggy.routes);
}
export { Ziggy };

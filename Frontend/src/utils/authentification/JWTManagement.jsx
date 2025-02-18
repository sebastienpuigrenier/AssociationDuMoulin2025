export function isAdminAuth () {
    const parsedToken = parseJwt(localStorage.getItem("associationDuMoulinToken"))
    const roles = parsedToken["roles"]
    return roles.includes('ROLE_ADMIN')
}

export function isUtilisateurAuth () {
    const parsedToken = parseJwt(localStorage.getItem("associationDuMoulinToken"))
    const roles = parsedToken["roles"]
    return roles.includes('ROLE_USER')
}

export function isLogInAuth () {
    return !!localStorage.getItem('associationDuMoulinToken')
}

function parseJwt (token) {
    var base64Url = token.split('.')[1];
    var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
    var jsonPayload = decodeURIComponent(window.atob(base64).split('').map(function(c) {
        return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
    }).join(''));

    return JSON.parse(jsonPayload);
}
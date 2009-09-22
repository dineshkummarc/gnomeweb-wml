
function addSearchProvider(url) {
    try {
        window.external.AddSearchProvider(url);
    } catch(e) {
        alert("Your browser does not support search engines. Try for instance Firefox"); 
    }
}

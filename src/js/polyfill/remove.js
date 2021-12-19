(function() {
    function remove() { this.parentNode && this.parentNode.removeChild(this); }
    if (!Element.prototype.remove) Element.prototype.remove = remove;
    if (Text && !Text.prototype.remove) Text.prototype.remove = remove;
})();

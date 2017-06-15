/**
 * Gestione dialogo con il server
 */
var serverManager = {};

/**
 * Chiamata al controller
 * @param string pageId Id pagina
 * @param string componentId Id componente
 * @param string eventId Id evento
 */
serverManager.invokeController = function(pageId, componentId, eventId) {
    
    var tags = $("meta[data-type='custom']");
    var meta = [];
    tags.each(function(idx, value) {
        meta.push({
           id: value.getAttribute('data-id'),
           value: value.getAttribute('data-value')
        });
    });
    
    var processBlocks = function(blocks) {
        blocks.forEach(function(block) {
            $('#' + block.name).html(block.content);
        });
    };
    
    var processActions = function(actions) {
        actions.forEach(function(action) {
            clientActions[action.name](action.params);
        });
    };
    
    request = $.ajax({
        url: '/controller',
        type: 'post',
        data: {
            pageId: pageId,
            componentId: componentId,
            eventId: eventId,
            meta: meta
        }
    });
    
    request.done(function (response, textStatus, jqXHR){
        var decoded = JSON.parse(response);
        
        processBlocks(decoded.blocks);
        processActions(decoded.actions);
    });
    
    request.fail(function (jqXHR, textStatus, errorThrown){
        alert("Fail: " + textStatus);
    });
    
};


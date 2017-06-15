var serverManager = {};

serverManager.callServer = function(data) {
    
    var processBlocks = function(blocks) {
        blocks.forEach(function(block) {
            $('#' + block.name).html(block.content);
        });
    };
    
    request = $.ajax({
        url: "/controller",
        type: "post",
        data: data
    });
    
    request.done(function (response, textStatus, jqXHR){
        var decoded = JSON.parse(response);
        processBlocks(decoded.blocks);
    });
    
    request.fail(function (jqXHR, textStatus, errorThrown){
        alert("Fail: " + textStatus);
    });
    
};



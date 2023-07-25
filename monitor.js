$(document).ready(function() {
    getOnlinePlayers();
    setInterval(getOnlinePlayers, 3000);
});

function getOnlinePlayers() {
    $.ajax({
        url: "monitor.php",
        type: "GET",
        dataType: "json",
        success: function(data) {
            var onlinePlayers = data.onlinePlayers;
            var maxPlayers = data.maxPlayers;

            if (maxPlayers === "-") {
                $("#online-players").html("<h2>Сервер временно недоступен</h2>");
                $(".progress-bar, .progress-fill").hide();
            } else {
                $("#online-players").html("<h2>Сейчас онлайн на сервере: " + onlinePlayers + " из " + maxPlayers + " игроков</h2>");
            
                var progressBarWidth = (onlinePlayers / maxPlayers) * 100 + "%";
                $(".progress-fill").css("width", progressBarWidth);
                $(".progress-bar, .progress-fill").show();
            
                // код для отображения progressBar
                window.addEventListener("load", function() {
                    setTimeout(function() {
                        var progressBar = document.querySelector(".progress-fill");
                        progressBar.style.display = "block";
                        setTimeout(function() {
                            progressBar.style.transition = "opacity 500ms";
                            progressBar.style.opacity = "1";
                        }, 500);
                    }, 3000);
                });
            }
            window.addEventListener("load", function() {
                setTimeout(function() {
                    var progressBar = document.querySelector(".progress-bar");
                    progressBar.style.display = "block";
                    setTimeout(function() {
                        progressBar.style.transition = "opacity 500ms";
                        progressBar.style.opacity = "1";
                    }, 500);
                }, 3000);
            });
        },
        error: function() {
            console.log("Error occurred while getting online players.");
        }
    });
}
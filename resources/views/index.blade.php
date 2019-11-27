<!DOCTYPE html>
<html>
    <head>
        <title>{{ env('APP_NAME') }}</title>
        <style type="text/css">
            .content {
                max-width: 700px;
                margin: auto;
            }
            h1 { color:limegreen; }
            .big { font-size:200%; }
            .card {
                /* Add shadows to create the "card" effect */
                box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
                transition: 0.3s;
                height: 70%;
                width: 70%;
            }

            /* On mouse-over, add a deeper shadow */
            .card:hover {
                box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
            }

            /* Add some padding inside the card container */
            .container {
                padding: 2px 16px;
            }

            /* Center the loader */
            #loader {
                position: absolute;
                left: 50%;
                top: 50%;
                z-index: 1;
                width: 150px;
                height: 150px;
                margin: -75px 0 0 -75px;
                border: 16px solid #f3f3f3;
                border-radius: 50%;
                border-top: 16px solid #3498db;
                width: 120px;
                height: 120px;
                -webkit-animation: spin 2s linear infinite;
                animation: spin 2s linear infinite;
            }

            @-webkit-keyframes spin {
                0% { -webkit-transform: rotate(0deg); }
                100% { -webkit-transform: rotate(360deg); }
            }

            @keyframes spin {
                0% { transform: rotate(0deg); }
                100% { transform: rotate(360deg); }
            }

            /* Add animation to "page content" */
            .animate-bottom {
                position: relative;
                -webkit-animation-name: animatebottom;
                -webkit-animation-duration: 1s;
                animation-name: animatebottom;
                animation-duration: 1s
            }

            @-webkit-keyframes animatebottom {
                from { bottom:-100px; opacity:0 }
                to { bottom:0px; opacity:1 }
            }

            @keyframes animatebottom {
                from{ bottom:-100px; opacity:0 }
                to{ bottom:0; opacity:1 }
            }

            #response {
                display: none;
            }
        </style>
    </head>
    <body>
        <div class="content">
            <header>
                <h1>Youtube Search</h1>
            </header>
            <main>
                <form>
                    <input type="text" id="searchText"/>
                    <button id="search">Search Youtube</button>
                </form>
                <div id="loader" style="display:none;"></div>
                <hr />
                <div id="response" class="animate-bottom"></div>
            </main>
            <footer>
            </footer>
        </div>
        <script>
            document.getElementById("search").addEventListener("click", async (e) => {
                e.preventDefault();
                document.getElementById("loader").style.display = null;
                let q = document.getElementById('searchText').value;

                try {
                    const data = await postData('/search', { query: q });
                    // console.log(JSON.stringify(data));
                    console.log(data);
                    let output = '<h2>Results</h2>';

                    data.forEach(function(youtube) {
                        output += `
                            <div class="card">
                                <img src="${youtube.snippet.thumbnails.default.url}" alt="Avatar" style="width:100%">
                                <div class="container">
                                    <h4>Title: <b>${youtube.snippet.title}</b></h4>
                                    <p>${youtube.snippet.channelTitle}</p>
                                </div>
                            </div><br /><br /><br /><hr />
                        `;
                    });

                    document.getElementById("response").innerHTML = output;
                    document.getElementById("loader").style.display = "none";
                    document.getElementById("response").style.display = "block";
                } catch (error) {
                    console.error(error);
                }
            });

            async function postData(url = '', data = {}) {
                const response = await fetch(url, {
                    method: 'POST',
                    mode: 'cors',
                    cache: 'no-cache',
                    credentials: 'same-origin',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    redirect: 'follow',
                    referrer: 'no-referrer',
                    body: JSON.stringify(data)
                });

                return await response.json();
            }
        </script>
    </body>
</html>

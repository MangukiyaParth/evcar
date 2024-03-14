jQuery(function () {
    getnewsdetails();
});
    
function getnewsdetails(){
    var req_data = {
        op: "manage_homepage",
        action: "get_news_details",
        title: PRIMARY_ID
    };
    doAPICall(req_data, async function(data){
        if (data && data != null && data.success == true) {
            var newsData = data.data;
            $(".news_title").html(newsData.title);
            var html_news = `<div class="w-100">
                                <h2 class="mb-4">${newsData.title}</h2>
                                <img src="${WEB_API_FOLDER+newsData.main_image}" class="w-100" alt="2stcar">
                                <h6 class="dates mb-3">${newsData.disp_date}</h6>
                                <div class="csrnewsub general-description">${newsData.description.replaceAll("\\","")}</div>
                            </div>`;
            $("#news_list").html(html_news);
            return false;
        }
        else if (data && data != null && data.success == false) {
            return false;
        }
    });
}
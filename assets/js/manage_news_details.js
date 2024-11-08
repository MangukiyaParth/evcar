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
            var newsData = decryptAES256CBC(data.data);
            $(".news_title").html(newsData.title);
            var html_news = `<div class="w-100">
                                <h2 class="mb-4">${newsData.title}</h2>
                                <img src="${WEB_API_FOLDER+newsData.main_image.replace('/images_thumb/','/images_thumb/')}" class="tmp-img w-100" alt="2stcar" loading="lazy">
                                <h6 class="dates mb-3">${newsData.disp_date}</h6>
                                <div class="csrnewsub general-description">${newsData.description.replaceAll("\\","")}</div>`;
            if(newsData.tags && newsData.tags != "" && newsData.tags != "[]"){
                let tags = JSON.parse(newsData.tags.replace(/\\"/g,'"'), true);
                html_news += `<ul class="tag-list">`;
                tags.forEach(tag => { 
                    html_news += `<li># ${tag}</li>`;
                });
                html_news += `</ul>`;
            }
            html_news += `</div>`;
            $("#news_list").html(html_news);
            // show_real_image("#news_list .tmp-img");
            return false;
        }
        else if (data && data != null && data.success == false) {
            return false;
        }
    });
}
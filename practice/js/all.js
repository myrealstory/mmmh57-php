axios
    .get("https://hexschool.github.io/ajaxHomework/data.json")
    .then(function (response) {
        // console.log(response.data);
        // console.log(response.status);
        // console.log(response.statusText);
        // console.log(response.headers);
        // console.log(response.config);

        let ary = response.data;
        console.log(ary[0].name);
        const title = document.querySelector(".title");
        title.textContent = ary[0].name;

    });

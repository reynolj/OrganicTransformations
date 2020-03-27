export default class Pages {

    constructor(list, name) {
        this.name = name;
        this.width = 4;
        this.list = list;
        this.cur_page = 1;
        this.first_page = 1;
        this.last_page = (Math.floor(this.list.length/this.width)) + 1;
    }

    get_page_set() {
        let pages = [
            this.cur_page - 2,
            this.cur_page - 1,
            this.cur_page,
            this.cur_page + 1,
            this.cur_page + 2
        ];
        if(pages.includes(this.first_page))
        {
            pages = pages.slice(pages.indexOf(this.first_page));
        }
        if(pages.includes(this.last_page))
        {
            pages.splice(pages.indexOf(this.last_page) + 1);
        }
        return pages;
    }

    set_current_page(page) {
        if(page > this.last_page || page < this.first_page) return;
        this.cur_page = page;
    }

    get_numbers(set) {
        let string = Array();
        for(let number in set) {
            if(set.hasOwnProperty(number)) {
                if(set[number] === this.cur_page) string.push('<li class="page-nav text current-page" id="' + this.name + ':' + set[number] + '">' + set[number] + '</li>');
                else string.push('<li class="page-nav text" id="' + this.name + ':' + set[number] + '">' + set[number] + '</li>');
            }
        }
        return string.join("");
    }

    get_current_page_html() {
        let string = Array();
        const set = this.get_page_set();
        string.push(
            '<div class="row">' +
                '<div class="col-12">' +
                    '<ul class="page-nav float-left">' +
                        '<li class="fas fa-angle-double-left page-nav icon" id="' + this.name + ':' + this.first_page + '"></li>'
        );
        string.push(this.get_numbers(set));
        string.push(
                        '<li class="fas fa-angle-double-right page-nav icon" id="' + this.name + ':' + this.last_page + '"></li>' +
                    '</ul>' +
                '</div>' +
            '</div>' +
            '<div class="row">'
        );

        for(let i = this.width * (this.cur_page - 1); i < this.list.length && i < (this.width * this.cur_page); ++i) {
            string.push(this.list[i].card);
        }

        string.push(
            '</div>' +
            '<div class="row">' +
                '<div class="col-12">' +
                    '<ul class="page-nav float-right">' +
                        '<li class="fas fa-angle-double-left page-nav icon" id="' + this.name + ':' + this.first_page + '"></li>'
        );
        string.push(this.get_numbers(set));
        string.push(
                        '<li class="fas fa-angle-double-right page-nav icon" id="' + this.name + ':' + this.last_page + '"></li>' +
                    '</ul>' +
                '</div>' +
            '</div>'
        );
        return string.join("");
    }
};
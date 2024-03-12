export function coutMaxPages(data, part_items){
    return Math.floor(1+data.length/part_items) 
}

export function newPage(data, page,part_items){
    return data.slice(0 + part_items * ( page - 1 ), part_items * page)
}
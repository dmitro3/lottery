export default class Ajax {

    public static get(url: string, data: any = {}) {
        return new Promise((resolve, reject) => {
            XHR.send({
                url: url,
                method: "GET",
                data: data
            }).then((res: any) => {
                if (res.code == 200 && res.html) {
                    resolve(res);
                }
                else {
                    reject(res);
                }
            });
        })
    }
}
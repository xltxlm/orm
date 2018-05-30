package Swoole

type Request struct {
    /* 数据库配置 */
    pdoaction \xltxlm\ormTool\Template\PdoAction

    /* 需要调起的函数 */
    callfunction string

}

func NewRequest() *Request{
    var this = new(Request)
    return this
}



<?php
/**
 * @link https://www.zhongxinwanka.com/
 *
 * @copyright Copyright (c) 2018 众鑫玩卡
 */

/**
 * @see https://github.com/zircote/swagger-php/tree/2.x/Examples/
 * @SWG\Swagger(
 *     basePath="/v1/",
 *     host="api.example.com",
 *     schemes={"http"},
 *     produces={"application/json"},
 *     consumes={"application/json"},
 *     @SWG\Info(
 *         version="1.0.0",
 *         title="EXAMPLE WEB API",
 *         description="接口地址：http://api.example.com/",
 *         termsOfService="",
 *         @SWG\Contact(name="PHP Team"),
 *         @SWG\License(name="")
 *     ),
 *     @SWG\Definition(
 *         definition="Error",
 *         type="object",
 *         required={"code", "msg"},
 *         @SWG\Property( property="code", type="integer", description="响应状态", example="0"),
 *         @SWG\Property( property="message", type="string", description="响应消息", example="操作失败"),
 *     ),
 *     @SWG\Definition(
 *         definition="Success",
 *         type="object",
 *         required={"code", "msg"},
 *         @SWG\Property( property="code", type="integer", description="响应状态", example="1"),
 *         @SWG\Property( property="message", type="string
 * ", description="响应消息", example="操作成功"),
 *     ),
 * )
 */
class ApiController
{
    /**
     * 用户注册.
     *
     * @SWG\Swagger(
     *     @SWG\Definition(
     *         definition="Reg",
     *         type="object",
     *         description = "用户注册模型",
     *         required={"sms_code", "phone", "password"},
     *         @SWG\Property( property="sms_code", type="string", description="短信验证码", example="15389898989"),
     *         @SWG\Property( property="phone", type="string", description="手机号", example="15389898989"),
     *         @SWG\Property( property="password", type="string", description="登录密码", example="123456"),
     *     ),
     * )
     *
     * @SWG\Post(path="/api/index/reg",
     *     tags = {"注册登录"},
     *     summary = "用户注册",
     *     produces = {"application/json"},
     *     consumes = {"application/json"},
     *     @SWG\Parameter(
     *         name = "body",
     *         in = "body",
     *         description = "用户登录信息",
     *         required = true,
     *         @SWG\Schema(ref="#/definitions/Reg"),
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "用户注册返回",
     *         @SWG\Schema(ref="#/definitions/Success"),
     *         @SWG\Header(header="Content-Type", type="application/json; charset=UTF-8")
     *     )
     * )
     */
    public function Reg()
    {
    }

    /**
     *
     * @SWG\Post(path="Login",
     *     tags = {"注册登录"},
     *     summary = "用户登陆",
     *     produces = {"application/json"},
     *     consumes = {"application/json"},
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "username",
     *        description = "用户名",
     *        required = true,
     *        type = "string",
     *        default = "admin"
     *     ),
     *     @SWG\Parameter(
     *        in = "formData",
     *        name = "password",
     *        description = "密码",
     *        required = true,
     *        type = "string",
     *        default = "123456"
     *     ),
     *     @SWG\Response(
     *         response = 200,
     *         description = "用户登陆返回",
     *         @SWG\Schema(ref="#/definitions/Success"),
     *         @SWG\Header(header="Content-Type", type="application/json; charset=UTF-8")
     *     )
     * )
     */
    public function Login()
    {
    }
}

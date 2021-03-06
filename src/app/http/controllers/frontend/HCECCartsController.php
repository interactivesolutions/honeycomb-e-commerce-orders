<?php

namespace interactivesolutions\honeycombecommerceorders\app\http\controllers\frontend;

use DB;
use HCLog;
use Illuminate\Http\Request;
use interactivesolutions\honeycombcore\http\controllers\HCBaseController;
use interactivesolutions\honeycombecommerceorders\app\services\HCCartService;
use interactivesolutions\honeycombecommerceorders\app\services\HCUserCartService;

class HCECCartsController extends HCBaseController
{
    /**
     * @var HCUserCartService
     */
    protected $userCartService;

    /**
     * @var HCCartService
     */
    protected $cartService;

    /**
     * RGCartController constructor.
     *
     * @param HCUserCartService $userCartService
     * @param HCCartService $cartService
     */
    public function __construct(HCUserCartService $userCartService, HCCartService $cartService)
    {
        $this->userCartService = $userCartService;
        $this->cartService = $cartService;
    }

    /**
     * Add items to cart
     *
     * @param Request $request
     * @return array
     */
    public function add(Request $request)
    {
        $v = \Validator::make($request->all(), [
            'goods_id'       => 'required|exists:hc_goods,id',
//            'combination_id' => 'required|exists:hc_goods_combinations,id',
            'amount'         => 'required|integer|min:1',
        ]);

        if( $v->fails() ) {
            return $v->messages();
        }

        $cartId = $this->cartService->getCartId($request, true);

        DB::beginTransaction();

        try {
            $this->userCartService->add($cartId, $request->input('goods_id'), $request->input('combination_id'), $request->input('amount'));
        } catch ( \Exception $e ) {
            DB::rollback();

            return HCLog::info('CART-001', $e->getMessage());
        }

        DB::commit();

        return hcSuccess();
    }

    /**
     * Update cart item amount
     *
     * @param Request $request
     * @param $cartItemId
     * @return array
     */
    public function update(Request $request, $cartItemId)
    {
        $v = \Validator::make($request->all(), [
            'amount' => 'required|integer|min:1',
        ], [
            'amount' => 'Kiekis',
        ]);

        if( $v->fails() ) {
            return $v->messages();
        }

        DB::beginTransaction();

        try {
            $cartId = $this->cartService->getCartId($request, true);

            $this->userCartService->update($cartId, $cartItemId, $request->input('amount'));
        } catch ( \Exception $e ) {
            DB::rollback();

            return HCLog::info('CART-002', $e->getMessage());
        }

        DB::commit();

        return hcSuccess();
    }


    /**
     * Remove cart item from cart
     *
     * @param Request $request
     * @param $cartItemId
     * @return array
     */
    public function delete(Request $request, $cartItemId)
    {
        DB::beginTransaction();

        try {
            $cartId = $this->cartService->getCartId($request, true);

            $this->userCartService->remove($cartId, $cartItemId);
        } catch ( \Exception $e ) {
            DB::rollback();

            return HCLog::info('CART-003', $e->getMessage());
        }

        DB::commit();

        return hcSuccess();
    }
}

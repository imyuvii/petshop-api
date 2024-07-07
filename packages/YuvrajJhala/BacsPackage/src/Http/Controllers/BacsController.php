<?php

namespace YuvrajJhala\BacsPackage\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class BacsController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/v1/bacs-response",
     *     tags={"Bacs"},
     *     summary="Get BACS Response",
     *     @OA\Response(
     *         response=200,
     *         description="BACS Response",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="vol", type="string"),
     *                 @OA\Property(property="hdr1", type="string"),
     *                 @OA\Property(property="hdr2", type="string"),
     *                 @OA\Property(property="uhl", type="string"),
     *                 @OA\Property(property="standard", type="array", @OA\Items(type="string")),
     *                 @OA\Property(property="eof1", type="string"),
     *                 @OA\Property(property="eof2", type="string"),
     *                 @OA\Property(property="utl", type="string")
     *             )
     *         )
     *     )
     * )
     */
    public function getBacsResponse(): JsonResponse
    {
        $data = [
            'vol' => 'VOL1Mk2OPn0                              BACSNO                                1',
            'hdr1' => 'HDR1ABACSNOS   BACSNOMk2OPn00010001100010 22087 2308900000003LUNL7m9p1lfZ       ',
            'hdr2' => 'HDR2F0200000106                                   00                            ',
            'uhl' => 'UHL1 22087999999    000000004 MULTI  721       AUD5020                          ',
            'standard' => [
                '1234561234567800N12345612345678/RO100000010000Test              123&abc           TestTestTestTestTe 22087',
            ],
            'eof1' => 'EOF1ABACSNOS   BACSNOMk2OPn00010001100010 22087 230890UEg9lb3LUNL7m9p1lfZ       ',
            'eof2' => 'EOF2F0200000106                                   00                            ',
            'utl' => 'UTL10000000000000000000000000000000000000000        0000001                     ',
        ];

        return response()->json(['data' => $data]);
    }
}

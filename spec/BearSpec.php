<?php

use App\Bear;
use kahlan\plugin\Monkey;
use kahlan\plugin\Stub;

describe("Bear", function() {
    describe("::wrath", function() {
        it('should demonstrate Bear super-power', function() {
            expect(Bear::wrath())->toEqual('WRAAAAATH');
        });
    });

    describe("::isSleepy", function() {
        it('should not be sleepy if it is before 21:00', function() {
            Monkey::patch('time', function() {
                return "1465502399";
            });
            expect(Bear::isSleepy())->toEqual(false);
        });

        it('should be at least sleepy if it is 21:00 or later', function() {
            Monkey::patch('time', function() {
                return "1465502400";
            });
            expect(Bear::isSleepy())->toEqual(true);
        });
    });

    describe('->doHug()', function () {
        it('delegates a hug to a hugger instance nearby', function () {
            $hugger = Stub::create(['implements' => ['App\Huggable']]);
            Stub::on($hugger)->method('hug')->andReturn(new \App\Hug);

            $bear = new Bear($hugger);
            expect($bear->doHug())->toEqual('(つ´∀｀)つ');
        });
    });
});

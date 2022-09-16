<?php

declare(strict_types=1);

namespace App\Core\PHPStan;

use App\Shared\Application\Query\QueryBusInterface;
use PhpParser\Node\Expr\MethodCall;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\ParametersAcceptorSelector;
use PHPStan\Reflection\ReflectionProvider;
use PHPStan\Type\DynamicMethodReturnTypeExtension;
use PHPStan\Type\Type;

class QueryBusDynamicReturnTypeExtension implements DynamicMethodReturnTypeExtension
{
    private ReflectionProvider $reflectionProvider;

    public function __construct(
        ReflectionProvider $reflectionProvider
    ) {
        $this->reflectionProvider = $reflectionProvider;
    }

    public function getClass(): string
    {
        return QueryBusInterface::class;
    }

    public function isMethodSupported(MethodReflection $methodReflection): bool
    {
        return 'execute' === $methodReflection->getName();
    }

    public function getTypeFromMethodCall(
        MethodReflection $methodReflection,
        MethodCall $methodCall,
        Scope $scope
    ): ?Type {
        $busQueryArg = $methodCall->getArgs()[0];
        $queryClassName = $scope->getType($busQueryArg->value)->getReferencedClasses()[0];
        $handlerClassName = $queryClassName.'Handler';

//        if (!class_exists($handlerClassName)) {
//            return null;
//        }

        $handlerReflection = $this->reflectionProvider->getClass($handlerClassName);
        $invokeMethod = $handlerReflection->getMethod('__invoke', $scope);

        return ParametersAcceptorSelector::combineAcceptors(
            $invokeMethod->getVariants()
        )->getReturnType();
    }
}

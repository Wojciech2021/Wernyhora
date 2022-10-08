<?php

namespace ContainerFHRep1H;
include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'doctrine'.\DIRECTORY_SEPARATOR.'persistence'.\DIRECTORY_SEPARATOR.'src'.\DIRECTORY_SEPARATOR.'Persistence'.\DIRECTORY_SEPARATOR.'ObjectManager.php';
include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'doctrine'.\DIRECTORY_SEPARATOR.'orm'.\DIRECTORY_SEPARATOR.'lib'.\DIRECTORY_SEPARATOR.'Doctrine'.\DIRECTORY_SEPARATOR.'ORM'.\DIRECTORY_SEPARATOR.'EntityManagerInterface.php';
include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'doctrine'.\DIRECTORY_SEPARATOR.'orm'.\DIRECTORY_SEPARATOR.'lib'.\DIRECTORY_SEPARATOR.'Doctrine'.\DIRECTORY_SEPARATOR.'ORM'.\DIRECTORY_SEPARATOR.'EntityManager.php';

class EntityManager_9a5be93 extends \Doctrine\ORM\EntityManager implements \ProxyManager\Proxy\VirtualProxyInterface
{
    /**
     * @var \Doctrine\ORM\EntityManager|null wrapped object, if the proxy is initialized
     */
    private $valueHolder1104a = null;

    /**
     * @var \Closure|null initializer responsible for generating the wrapped object
     */
    private $initializer7c9b8 = null;

    /**
     * @var bool[] map of public properties of the parent class
     */
    private static $publicPropertiesd99f1 = [
        
    ];

    public function getConnection()
    {
        $this->initializer7c9b8 && ($this->initializer7c9b8->__invoke($valueHolder1104a, $this, 'getConnection', array(), $this->initializer7c9b8) || 1) && $this->valueHolder1104a = $valueHolder1104a;

        return $this->valueHolder1104a->getConnection();
    }

    public function getMetadataFactory()
    {
        $this->initializer7c9b8 && ($this->initializer7c9b8->__invoke($valueHolder1104a, $this, 'getMetadataFactory', array(), $this->initializer7c9b8) || 1) && $this->valueHolder1104a = $valueHolder1104a;

        return $this->valueHolder1104a->getMetadataFactory();
    }

    public function getExpressionBuilder()
    {
        $this->initializer7c9b8 && ($this->initializer7c9b8->__invoke($valueHolder1104a, $this, 'getExpressionBuilder', array(), $this->initializer7c9b8) || 1) && $this->valueHolder1104a = $valueHolder1104a;

        return $this->valueHolder1104a->getExpressionBuilder();
    }

    public function beginTransaction()
    {
        $this->initializer7c9b8 && ($this->initializer7c9b8->__invoke($valueHolder1104a, $this, 'beginTransaction', array(), $this->initializer7c9b8) || 1) && $this->valueHolder1104a = $valueHolder1104a;

        return $this->valueHolder1104a->beginTransaction();
    }

    public function getCache()
    {
        $this->initializer7c9b8 && ($this->initializer7c9b8->__invoke($valueHolder1104a, $this, 'getCache', array(), $this->initializer7c9b8) || 1) && $this->valueHolder1104a = $valueHolder1104a;

        return $this->valueHolder1104a->getCache();
    }

    public function transactional($func)
    {
        $this->initializer7c9b8 && ($this->initializer7c9b8->__invoke($valueHolder1104a, $this, 'transactional', array('func' => $func), $this->initializer7c9b8) || 1) && $this->valueHolder1104a = $valueHolder1104a;

        return $this->valueHolder1104a->transactional($func);
    }

    public function wrapInTransaction(callable $func)
    {
        $this->initializer7c9b8 && ($this->initializer7c9b8->__invoke($valueHolder1104a, $this, 'wrapInTransaction', array('func' => $func), $this->initializer7c9b8) || 1) && $this->valueHolder1104a = $valueHolder1104a;

        return $this->valueHolder1104a->wrapInTransaction($func);
    }

    public function commit()
    {
        $this->initializer7c9b8 && ($this->initializer7c9b8->__invoke($valueHolder1104a, $this, 'commit', array(), $this->initializer7c9b8) || 1) && $this->valueHolder1104a = $valueHolder1104a;

        return $this->valueHolder1104a->commit();
    }

    public function rollback()
    {
        $this->initializer7c9b8 && ($this->initializer7c9b8->__invoke($valueHolder1104a, $this, 'rollback', array(), $this->initializer7c9b8) || 1) && $this->valueHolder1104a = $valueHolder1104a;

        return $this->valueHolder1104a->rollback();
    }

    public function getClassMetadata($className)
    {
        $this->initializer7c9b8 && ($this->initializer7c9b8->__invoke($valueHolder1104a, $this, 'getClassMetadata', array('className' => $className), $this->initializer7c9b8) || 1) && $this->valueHolder1104a = $valueHolder1104a;

        return $this->valueHolder1104a->getClassMetadata($className);
    }

    public function createQuery($dql = '')
    {
        $this->initializer7c9b8 && ($this->initializer7c9b8->__invoke($valueHolder1104a, $this, 'createQuery', array('dql' => $dql), $this->initializer7c9b8) || 1) && $this->valueHolder1104a = $valueHolder1104a;

        return $this->valueHolder1104a->createQuery($dql);
    }

    public function createNamedQuery($name)
    {
        $this->initializer7c9b8 && ($this->initializer7c9b8->__invoke($valueHolder1104a, $this, 'createNamedQuery', array('name' => $name), $this->initializer7c9b8) || 1) && $this->valueHolder1104a = $valueHolder1104a;

        return $this->valueHolder1104a->createNamedQuery($name);
    }

    public function createNativeQuery($sql, \Doctrine\ORM\Query\ResultSetMapping $rsm)
    {
        $this->initializer7c9b8 && ($this->initializer7c9b8->__invoke($valueHolder1104a, $this, 'createNativeQuery', array('sql' => $sql, 'rsm' => $rsm), $this->initializer7c9b8) || 1) && $this->valueHolder1104a = $valueHolder1104a;

        return $this->valueHolder1104a->createNativeQuery($sql, $rsm);
    }

    public function createNamedNativeQuery($name)
    {
        $this->initializer7c9b8 && ($this->initializer7c9b8->__invoke($valueHolder1104a, $this, 'createNamedNativeQuery', array('name' => $name), $this->initializer7c9b8) || 1) && $this->valueHolder1104a = $valueHolder1104a;

        return $this->valueHolder1104a->createNamedNativeQuery($name);
    }

    public function createQueryBuilder()
    {
        $this->initializer7c9b8 && ($this->initializer7c9b8->__invoke($valueHolder1104a, $this, 'createQueryBuilder', array(), $this->initializer7c9b8) || 1) && $this->valueHolder1104a = $valueHolder1104a;

        return $this->valueHolder1104a->createQueryBuilder();
    }

    public function flush($entity = null)
    {
        $this->initializer7c9b8 && ($this->initializer7c9b8->__invoke($valueHolder1104a, $this, 'flush', array('entity' => $entity), $this->initializer7c9b8) || 1) && $this->valueHolder1104a = $valueHolder1104a;

        return $this->valueHolder1104a->flush($entity);
    }

    public function find($className, $id, $lockMode = null, $lockVersion = null)
    {
        $this->initializer7c9b8 && ($this->initializer7c9b8->__invoke($valueHolder1104a, $this, 'find', array('className' => $className, 'id' => $id, 'lockMode' => $lockMode, 'lockVersion' => $lockVersion), $this->initializer7c9b8) || 1) && $this->valueHolder1104a = $valueHolder1104a;

        return $this->valueHolder1104a->find($className, $id, $lockMode, $lockVersion);
    }

    public function getReference($entityName, $id)
    {
        $this->initializer7c9b8 && ($this->initializer7c9b8->__invoke($valueHolder1104a, $this, 'getReference', array('entityName' => $entityName, 'id' => $id), $this->initializer7c9b8) || 1) && $this->valueHolder1104a = $valueHolder1104a;

        return $this->valueHolder1104a->getReference($entityName, $id);
    }

    public function getPartialReference($entityName, $identifier)
    {
        $this->initializer7c9b8 && ($this->initializer7c9b8->__invoke($valueHolder1104a, $this, 'getPartialReference', array('entityName' => $entityName, 'identifier' => $identifier), $this->initializer7c9b8) || 1) && $this->valueHolder1104a = $valueHolder1104a;

        return $this->valueHolder1104a->getPartialReference($entityName, $identifier);
    }

    public function clear($entityName = null)
    {
        $this->initializer7c9b8 && ($this->initializer7c9b8->__invoke($valueHolder1104a, $this, 'clear', array('entityName' => $entityName), $this->initializer7c9b8) || 1) && $this->valueHolder1104a = $valueHolder1104a;

        return $this->valueHolder1104a->clear($entityName);
    }

    public function close()
    {
        $this->initializer7c9b8 && ($this->initializer7c9b8->__invoke($valueHolder1104a, $this, 'close', array(), $this->initializer7c9b8) || 1) && $this->valueHolder1104a = $valueHolder1104a;

        return $this->valueHolder1104a->close();
    }

    public function persist($entity)
    {
        $this->initializer7c9b8 && ($this->initializer7c9b8->__invoke($valueHolder1104a, $this, 'persist', array('entity' => $entity), $this->initializer7c9b8) || 1) && $this->valueHolder1104a = $valueHolder1104a;

        return $this->valueHolder1104a->persist($entity);
    }

    public function remove($entity)
    {
        $this->initializer7c9b8 && ($this->initializer7c9b8->__invoke($valueHolder1104a, $this, 'remove', array('entity' => $entity), $this->initializer7c9b8) || 1) && $this->valueHolder1104a = $valueHolder1104a;

        return $this->valueHolder1104a->remove($entity);
    }

    public function refresh($entity)
    {
        $this->initializer7c9b8 && ($this->initializer7c9b8->__invoke($valueHolder1104a, $this, 'refresh', array('entity' => $entity), $this->initializer7c9b8) || 1) && $this->valueHolder1104a = $valueHolder1104a;

        return $this->valueHolder1104a->refresh($entity);
    }

    public function detach($entity)
    {
        $this->initializer7c9b8 && ($this->initializer7c9b8->__invoke($valueHolder1104a, $this, 'detach', array('entity' => $entity), $this->initializer7c9b8) || 1) && $this->valueHolder1104a = $valueHolder1104a;

        return $this->valueHolder1104a->detach($entity);
    }

    public function merge($entity)
    {
        $this->initializer7c9b8 && ($this->initializer7c9b8->__invoke($valueHolder1104a, $this, 'merge', array('entity' => $entity), $this->initializer7c9b8) || 1) && $this->valueHolder1104a = $valueHolder1104a;

        return $this->valueHolder1104a->merge($entity);
    }

    public function copy($entity, $deep = false)
    {
        $this->initializer7c9b8 && ($this->initializer7c9b8->__invoke($valueHolder1104a, $this, 'copy', array('entity' => $entity, 'deep' => $deep), $this->initializer7c9b8) || 1) && $this->valueHolder1104a = $valueHolder1104a;

        return $this->valueHolder1104a->copy($entity, $deep);
    }

    public function lock($entity, $lockMode, $lockVersion = null)
    {
        $this->initializer7c9b8 && ($this->initializer7c9b8->__invoke($valueHolder1104a, $this, 'lock', array('entity' => $entity, 'lockMode' => $lockMode, 'lockVersion' => $lockVersion), $this->initializer7c9b8) || 1) && $this->valueHolder1104a = $valueHolder1104a;

        return $this->valueHolder1104a->lock($entity, $lockMode, $lockVersion);
    }

    public function getRepository($entityName)
    {
        $this->initializer7c9b8 && ($this->initializer7c9b8->__invoke($valueHolder1104a, $this, 'getRepository', array('entityName' => $entityName), $this->initializer7c9b8) || 1) && $this->valueHolder1104a = $valueHolder1104a;

        return $this->valueHolder1104a->getRepository($entityName);
    }

    public function contains($entity)
    {
        $this->initializer7c9b8 && ($this->initializer7c9b8->__invoke($valueHolder1104a, $this, 'contains', array('entity' => $entity), $this->initializer7c9b8) || 1) && $this->valueHolder1104a = $valueHolder1104a;

        return $this->valueHolder1104a->contains($entity);
    }

    public function getEventManager()
    {
        $this->initializer7c9b8 && ($this->initializer7c9b8->__invoke($valueHolder1104a, $this, 'getEventManager', array(), $this->initializer7c9b8) || 1) && $this->valueHolder1104a = $valueHolder1104a;

        return $this->valueHolder1104a->getEventManager();
    }

    public function getConfiguration()
    {
        $this->initializer7c9b8 && ($this->initializer7c9b8->__invoke($valueHolder1104a, $this, 'getConfiguration', array(), $this->initializer7c9b8) || 1) && $this->valueHolder1104a = $valueHolder1104a;

        return $this->valueHolder1104a->getConfiguration();
    }

    public function isOpen()
    {
        $this->initializer7c9b8 && ($this->initializer7c9b8->__invoke($valueHolder1104a, $this, 'isOpen', array(), $this->initializer7c9b8) || 1) && $this->valueHolder1104a = $valueHolder1104a;

        return $this->valueHolder1104a->isOpen();
    }

    public function getUnitOfWork()
    {
        $this->initializer7c9b8 && ($this->initializer7c9b8->__invoke($valueHolder1104a, $this, 'getUnitOfWork', array(), $this->initializer7c9b8) || 1) && $this->valueHolder1104a = $valueHolder1104a;

        return $this->valueHolder1104a->getUnitOfWork();
    }

    public function getHydrator($hydrationMode)
    {
        $this->initializer7c9b8 && ($this->initializer7c9b8->__invoke($valueHolder1104a, $this, 'getHydrator', array('hydrationMode' => $hydrationMode), $this->initializer7c9b8) || 1) && $this->valueHolder1104a = $valueHolder1104a;

        return $this->valueHolder1104a->getHydrator($hydrationMode);
    }

    public function newHydrator($hydrationMode)
    {
        $this->initializer7c9b8 && ($this->initializer7c9b8->__invoke($valueHolder1104a, $this, 'newHydrator', array('hydrationMode' => $hydrationMode), $this->initializer7c9b8) || 1) && $this->valueHolder1104a = $valueHolder1104a;

        return $this->valueHolder1104a->newHydrator($hydrationMode);
    }

    public function getProxyFactory()
    {
        $this->initializer7c9b8 && ($this->initializer7c9b8->__invoke($valueHolder1104a, $this, 'getProxyFactory', array(), $this->initializer7c9b8) || 1) && $this->valueHolder1104a = $valueHolder1104a;

        return $this->valueHolder1104a->getProxyFactory();
    }

    public function initializeObject($obj)
    {
        $this->initializer7c9b8 && ($this->initializer7c9b8->__invoke($valueHolder1104a, $this, 'initializeObject', array('obj' => $obj), $this->initializer7c9b8) || 1) && $this->valueHolder1104a = $valueHolder1104a;

        return $this->valueHolder1104a->initializeObject($obj);
    }

    public function getFilters()
    {
        $this->initializer7c9b8 && ($this->initializer7c9b8->__invoke($valueHolder1104a, $this, 'getFilters', array(), $this->initializer7c9b8) || 1) && $this->valueHolder1104a = $valueHolder1104a;

        return $this->valueHolder1104a->getFilters();
    }

    public function isFiltersStateClean()
    {
        $this->initializer7c9b8 && ($this->initializer7c9b8->__invoke($valueHolder1104a, $this, 'isFiltersStateClean', array(), $this->initializer7c9b8) || 1) && $this->valueHolder1104a = $valueHolder1104a;

        return $this->valueHolder1104a->isFiltersStateClean();
    }

    public function hasFilters()
    {
        $this->initializer7c9b8 && ($this->initializer7c9b8->__invoke($valueHolder1104a, $this, 'hasFilters', array(), $this->initializer7c9b8) || 1) && $this->valueHolder1104a = $valueHolder1104a;

        return $this->valueHolder1104a->hasFilters();
    }

    /**
     * Constructor for lazy initialization
     *
     * @param \Closure|null $initializer
     */
    public static function staticProxyConstructor($initializer)
    {
        static $reflection;

        $reflection = $reflection ?? new \ReflectionClass(__CLASS__);
        $instance   = $reflection->newInstanceWithoutConstructor();

        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $instance, 'Doctrine\\ORM\\EntityManager')->__invoke($instance);

        $instance->initializer7c9b8 = $initializer;

        return $instance;
    }

    public function __construct(\Doctrine\DBAL\Connection $conn, \Doctrine\ORM\Configuration $config)
    {
        static $reflection;

        if (! $this->valueHolder1104a) {
            $reflection = $reflection ?? new \ReflectionClass('Doctrine\\ORM\\EntityManager');
            $this->valueHolder1104a = $reflection->newInstanceWithoutConstructor();
        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $this, 'Doctrine\\ORM\\EntityManager')->__invoke($this);

        }

        $this->valueHolder1104a->__construct($conn, $config);
    }

    public function & __get($name)
    {
        $this->initializer7c9b8 && ($this->initializer7c9b8->__invoke($valueHolder1104a, $this, '__get', ['name' => $name], $this->initializer7c9b8) || 1) && $this->valueHolder1104a = $valueHolder1104a;

        if (isset(self::$publicPropertiesd99f1[$name])) {
            return $this->valueHolder1104a->$name;
        }

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder1104a;

            $backtrace = debug_backtrace(false, 1);
            trigger_error(
                sprintf(
                    'Undefined property: %s::$%s in %s on line %s',
                    $realInstanceReflection->getName(),
                    $name,
                    $backtrace[0]['file'],
                    $backtrace[0]['line']
                ),
                \E_USER_NOTICE
            );
            return $targetObject->$name;
        }

        $targetObject = $this->valueHolder1104a;
        $accessor = function & () use ($targetObject, $name) {
            return $targetObject->$name;
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = & $accessor();

        return $returnValue;
    }

    public function __set($name, $value)
    {
        $this->initializer7c9b8 && ($this->initializer7c9b8->__invoke($valueHolder1104a, $this, '__set', array('name' => $name, 'value' => $value), $this->initializer7c9b8) || 1) && $this->valueHolder1104a = $valueHolder1104a;

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder1104a;

            $targetObject->$name = $value;

            return $targetObject->$name;
        }

        $targetObject = $this->valueHolder1104a;
        $accessor = function & () use ($targetObject, $name, $value) {
            $targetObject->$name = $value;

            return $targetObject->$name;
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = & $accessor();

        return $returnValue;
    }

    public function __isset($name)
    {
        $this->initializer7c9b8 && ($this->initializer7c9b8->__invoke($valueHolder1104a, $this, '__isset', array('name' => $name), $this->initializer7c9b8) || 1) && $this->valueHolder1104a = $valueHolder1104a;

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder1104a;

            return isset($targetObject->$name);
        }

        $targetObject = $this->valueHolder1104a;
        $accessor = function () use ($targetObject, $name) {
            return isset($targetObject->$name);
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $returnValue = $accessor();

        return $returnValue;
    }

    public function __unset($name)
    {
        $this->initializer7c9b8 && ($this->initializer7c9b8->__invoke($valueHolder1104a, $this, '__unset', array('name' => $name), $this->initializer7c9b8) || 1) && $this->valueHolder1104a = $valueHolder1104a;

        $realInstanceReflection = new \ReflectionClass('Doctrine\\ORM\\EntityManager');

        if (! $realInstanceReflection->hasProperty($name)) {
            $targetObject = $this->valueHolder1104a;

            unset($targetObject->$name);

            return;
        }

        $targetObject = $this->valueHolder1104a;
        $accessor = function () use ($targetObject, $name) {
            unset($targetObject->$name);

            return;
        };
        $backtrace = debug_backtrace(true, 2);
        $scopeObject = isset($backtrace[1]['object']) ? $backtrace[1]['object'] : new \ProxyManager\Stub\EmptyClassStub();
        $accessor = $accessor->bindTo($scopeObject, get_class($scopeObject));
        $accessor();
    }

    public function __clone()
    {
        $this->initializer7c9b8 && ($this->initializer7c9b8->__invoke($valueHolder1104a, $this, '__clone', array(), $this->initializer7c9b8) || 1) && $this->valueHolder1104a = $valueHolder1104a;

        $this->valueHolder1104a = clone $this->valueHolder1104a;
    }

    public function __sleep()
    {
        $this->initializer7c9b8 && ($this->initializer7c9b8->__invoke($valueHolder1104a, $this, '__sleep', array(), $this->initializer7c9b8) || 1) && $this->valueHolder1104a = $valueHolder1104a;

        return array('valueHolder1104a');
    }

    public function __wakeup()
    {
        \Closure::bind(function (\Doctrine\ORM\EntityManager $instance) {
            unset($instance->config, $instance->conn, $instance->metadataFactory, $instance->unitOfWork, $instance->eventManager, $instance->proxyFactory, $instance->repositoryFactory, $instance->expressionBuilder, $instance->closed, $instance->filterCollection, $instance->cache);
        }, $this, 'Doctrine\\ORM\\EntityManager')->__invoke($this);
    }

    public function setProxyInitializer(\Closure $initializer = null) : void
    {
        $this->initializer7c9b8 = $initializer;
    }

    public function getProxyInitializer() : ?\Closure
    {
        return $this->initializer7c9b8;
    }

    public function initializeProxy() : bool
    {
        return $this->initializer7c9b8 && ($this->initializer7c9b8->__invoke($valueHolder1104a, $this, 'initializeProxy', array(), $this->initializer7c9b8) || 1) && $this->valueHolder1104a = $valueHolder1104a;
    }

    public function isProxyInitialized() : bool
    {
        return null !== $this->valueHolder1104a;
    }

    public function getWrappedValueHolderValue()
    {
        return $this->valueHolder1104a;
    }
}

if (!\class_exists('EntityManager_9a5be93', false)) {
    \class_alias(__NAMESPACE__.'\\EntityManager_9a5be93', 'EntityManager_9a5be93', false);
}

<?php

namespace UTCode;

class Encode
{
    const PREFIX = 'ut';

    /**
     * @var mixed
     */
    private $data;

    /**
     * Encode constructor.
     *
     * @param mixed $data
     */
    public function __construct($data)
    {
        if (\is_object($data)) {
            $data = Common::objectToArray($data);
        } elseif (Common::isJson($data)) {
            $data = \json_decode($data, JSON_OBJECT_AS_ARRAY);
        }
        $this->data = $data;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        try {
            return \sprintf('%s:%s', self::PREFIX, $this->encode($this->data));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param mixed|null $data
     * @param string     $key
     *
     * @return string
     */
    public function encode($data = null, $key = ''): string
    {
        return $this->{'encode' . \ucfirst(\gettype($data))}($data, $key);
    }

    /**
     * @return string
     */
    private function encodeNull(): string
    {
        return 'n:e';
    }

    /**
     * @param bool   $part
     * @param string $key
     *
     * @return string
     */
    private function encodeBoolean(bool $part, string $key): string
    {
        return \sprintf('k%d:%sb:%be', \strlen($key), $key,
            (int)($part === true));
    }

    /**
     * @param float  $part
     * @param string $key
     *
     * @return string
     */
    private function encodeFloat(float $part, string $key): string
    {
        return \sprintf('k%d:%sf:%fe', \strlen($key), $key, $part);
    }

    /**
     * @param float  $part
     * @param string $key
     *
     * @return string
     */
    private function encodeDouble(float $part, string $key): string
    {
        return $this->encodeFloat($part, $key);
    }

    /**
     * @param int    $part
     * @param string $key
     *
     * @return string
     */
    private function encodeInteger(int $part, string $key): string
    {
        return \sprintf('k%d:%si:%de', \strlen($key), $key, $part);
    }

    /**
     * @param array  $data
     * @param string $key
     *
     * @return string
     */
    private function encodeArray(array $data, string $key)
    {
        \ksort($data);
        $key = ('integer' === \gettype($key)) ? '' : $key;
        $type = ('string' === \gettype($key)) ? 'd' : 'a';
        $result = ($key) ? \sprintf('k%d:%s%s:', \strlen($key), $key, $type)
            : \sprintf('%s%s:', $type, $key);
        foreach ($data as $key => $value) {
            $result .= $this->encode($value, $key);
        }
        return $result;
    }

    /**
     * @param string $part
     * @param string $key
     *
     * @return string
     */
    private function encodeString(string $part, string $key)
    {
        if (Common::isUnicode($part)) {
            return $this->encodeUnicode($part, $key);
        }
        return \sprintf('k%d:%ss%d:%se', \strlen($key), $key, \strlen($part),
            $part);
    }

    /**
     * @param string $part
     * @param string $key
     *
     * @return string
     */
    private function encodeUnicode(string $part, string $key): string
    {
        $str = \base64_encode($part);
        return \sprintf('k%d:%su%d:%se', \strlen($key), $key, \strlen($str),
            $str);
    }

}
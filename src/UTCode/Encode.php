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
        if (\is_array($data)) {
            $data = \json_decode(\json_encode($data));
        } elseif (Common::isJson($data)) {
            $data = \json_decode($data);
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
     * @param null   $data
     * @param string $key
     *
     * @return string
     */
    private function encodeNull($data = null, $key = ''): string
    {
        return \sprintf('k%d:%sn:e', \strlen($key), $key);
    }

    /**
     * @param bool   $part
     * @param string $key
     *
     * @return string
     */
    private function encodeBoolean(bool $part, string $key): string
    {
        return \sprintf('k%d:%sb:%b', \strlen($key), $key,
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
        return \sprintf('k%d:%sf:%fz', \strlen($key), $key, $part);
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
     * @param \stdClass $part
     * @param string    $key
     *
     * @return string
     */
    private function encodeObject(\stdClass $part, string $key): string
    {
        $result = ($key) ? \sprintf('k%d:%sd:', \strlen($key), $key)
            : \sprintf('d%s:', $key);
        foreach ($part as $key => $value) {
            $result .= $this->encode($value, $key);
        }
        return $result . 'e';
    }

    private function encodeArray(array $part, string $key): string
    {
        $result = [];
        foreach ($part as $sub) {
            \array_push($result, $this->encode($sub, ''));
        }
        return \sprintf('k%d:%sl:%s', \strlen($key), $key,
                \implode('', $result)) . 'e';
    }


    /**
     * @param string $part
     * @param string $key
     *
     * @return string
     */
    private function encodeString(string $part, string $key): string
    {
        return $this->encodeUnicode($part, $key);
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
        $kLen = \strlen($key) ? \sprintf('k%d:%s', \strlen($key), $key) : '';
        return \sprintf('%su%d:%s', $kLen, \strlen($str), $str);
    }

}
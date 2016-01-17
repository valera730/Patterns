<?
class Singleton
{
    private static $instance = null;

    public static function getInstance()
    {
        if (null === self::$instance)
        {
            self::$instance = new self();
        }
        return self::$instance;
    }
    private function __clone() {}
    private function __construct() {}
    public function test()
    {
        var_dump($this);
    }
}
$Object = Singleton::getInstance();  // ��������� �������
//����� ����� ����������, ��� ��� ���������� ������ ���� ���������
$Object -> test();
Singleton::getInstance() -> test();
// ������� ������� �������������� ��������� �������� � ������
$Object2 = new Singleton(); // Fatal error: Call to private Singleton::__construct() from invalid context
$Object3 = clone $Object; // Fatal error: Call to private Singleton::__clone() from context ''
?>
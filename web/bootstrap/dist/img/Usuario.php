<?php

namespace ITSEBRO\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;



/**
 * Usuario
 *
 * @ORM\Table(name="usuario", indexes={@ORM\Index(name="IDX_2265B05DDE734E51", columns={"cliente_id"})})
 * @ORM\Entity(repositoryClass="ITSEBRO\AdminBundle\Entity\UsuarioRepository")
 */
class Usuario implements UserInterface, \Serializable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="usuario_id_seq", allocationSize=1, initialValue=1)
     */
    protected  $id;


    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=255, nullable=true)
     */
    private $telefono;


    /**
     * @var string
     *
     * @ORM\Column(name="dir_entrega", type="string", length=255, nullable=true)
     */
    private $dirEntrega;

    /**
     * @var integer
     *
     * @ORM\Column(name="codido_postal", type="integer", nullable=true)
     */
    private $codidoPostal;

    /**
     * @var string
     *
     * @ORM\Column(name="puntos", type="string", length=255, nullable=true)
     */
    private $puntos;

    /**
     * @var \Cliente
     *
     *
     * @ORM\ManyToOne(targetEntity="ITSEBRO\ClienteBundle\Entity\Cliente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cliente_id", referencedColumnName="id", nullable=true)
     * })
     */
    private $cliente;


    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255, nullable=false)
     */
    protected  $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    protected  $password;

    /**
     * @var string
     *
     * @ORM\Column(name="rol", type="string", length=255, nullable=false)
     */
    private $rol;


    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255, nullable=false)
     */
    private $salt;

    /**
     * @var string
     *
     * @ORM\Column(name="correo", type="string", length=255, nullable=false)
     */
    private $correo;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Usuario
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return Usuario
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set dirEntrega
     *
     * @param string $dirEntrega
     * @return Usuario
     */
    public function setDirEntrega($dirEntrega)
    {
        $this->dirEntrega = $dirEntrega;

        return $this;
    }

    /**
     * Get dirEntrega
     *
     * @return string 
     */
    public function getDirEntrega()
    {
        return $this->dirEntrega;
    }

    /**
     * Set codidoPostal
     *
     * @param integer $codidoPostal
     * @return Usuario
     */
    public function setCodidoPostal($codidoPostal)
    {
        $this->codidoPostal = $codidoPostal;

        return $this;
    }

    /**
     * Get codidoPostal
     *
     * @return integer 
     */
    public function getCodidoPostal()
    {
        return $this->codidoPostal;
    }

    /**
     * Set puntos
     *
     * @param string $puntos
     * @return Usuario
     */
    public function setPuntos($puntos)
    {
        $this->puntos = $puntos;

        return $this;
    }

    /**
     * Get puntos
     *
     * @return string 
     */
    public function getPuntos()
    {
        return $this->puntos;
    }

    /**
     * Set cliente
     *
     * @param \ITSEBRO\ClienteBundle\Entity\Cliente $cliente
     * @return Usuario
     */
    public function setCliente(\ITSEBRO\ClienteBundle\Entity\Cliente $cliente = null)
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * Get cliente
     *
     * @return \ITSEBRO\ClienteBundle\Entity\Cliente 
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return Role[] The user roles
     */
    public function getRoles()
    {
        return array($this->rol);
    }

    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string The password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
       return $this->salt;
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }


    /**
     * Set username
     *
     * @param string $username
     * @return Usuario
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Usuario
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set rol
     *
     * @param string $rol
     * @return Usuario
     */
    public function setRol($rol)
    {
        $this->rol = $rol;

        return $this;
    }

    /**
     * Get rol
     *
     * @return string 
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return Usuario
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Set correo
     *
     * @param string $correo
     * @return Usuario
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;

        return $this;
    }

    /**
     * Get correo
     *
     * @return string 
     */
    public function getCorreo()
    {
        return $this->correo;
    }


    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * String representation of object
     * @link http://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->salt,
            $this->password,
        ));
    }

    /**
     * (PHP 5 &gt;= 5.1.0)<br/>
     * Constructs the object
     * @link http://php.net/manual/en/serializable.unserialize.php
     * @param string $serialized <p>
     * The string representation of the object.
     * </p>
     * @return void
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->salt,
            $this->password,
            ) = unserialize($serialized);
    }

    function __toString()
    {
        return $this->nombre;
    }
}

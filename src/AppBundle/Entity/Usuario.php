<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Serializable;
use Symfony\Component\Security\Core\Role\Role;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\User;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\UploadedFile;


/**
 * Usuario
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\UsuarioRepository")
 * @UniqueEntity("usuario",message="Este valor ya se está usando")
 */
class Usuario implements UserInterface, Serializable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100)
     */
    private $name;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Empresa", inversedBy="usuarios")
     */
    protected $empresa;

    /**
     *
     * @ORM\OneToMany(targetEntity="Modelo", mappedBy="usuario", cascade={"remove"})
     *
     */
    private $modelos;

    /**
     *
     * @ORM\OneToMany(targetEntity="Modelo101B", mappedBy="usuario", cascade={"remove"})
     *
     */
    private $modelos101B;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=255)
     */
    private $role;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=255, nullable=false)
     */
    private $salt;

    /**
     * @var string
     *
     * @ORM\Column(name="usuario", type="string", length=255, unique=true)
     */
    private $usuario;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var boolean
     *
     * @ORM\Column(name="grupo", type="boolean")
     */
    private $grupo;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta_foto", type="string", length=255, nullable=true)
     */
    private $rutafoto;

    /**
     * @Assert\Image(maxSize = "1000k")
     */
    private $foto;


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
     * Set name
     *
     * @param string $name
     *
     * @return Usuario
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Set grupo
     *
     * @param boolean $grupo
     *
     * @return Usuario
     */
    public function setGrupo($grupo)
    {
        $this->grupo = $grupo;

        return $this;
    }

    /**
     * Get grupo
     *
     * @return boolean
     */
    public function getGrupo()
    {
        return $this->grupo;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set empresa
     *
     * @param \AppBundle\Entity\Empresa $empresa
     *
     * @return Usuario
     */
    public function setEmpresa(\AppBundle\Entity\Empresa $empresa = null)
    {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * Get empresa
     *
     * @return \AppBundle\Entity\Empresa
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * Add modelo
     *
     * @param \AppBundle\Entity\Modelo $modelo
     *
     * @return Usuario
     */
    public function addModelo(\AppBundle\Entity\Modelo $modelo)
    {
        $this->modelos[] = $modelo;

        return $this;
    }

    /**
     * Remove modelo
     *
     * @param \AppBundle\Entity\Modelo $modelo
     */
    public function removeModelo(\AppBundle\Entity\Modelo $modelo)
    {
        $this->modelos->removeElement($modelo);
    }

    /**
     * Get modelos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getModelos()
    {
        return $this->modelos;
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
        // TODO: Implement getRoles() method.
        return  array($this->role);

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
        // TODO: Implement getPassword() method.
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
     * @param string $salt
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }



    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        $this->usuario;
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
     * Set usuario
     *
     * @param string $usuario
     *
     * @return Usuario
     */
    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get usuario
     *
     * @return string
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Usuario
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set role
     *
     * @param array $role
     *
     * @return Usuario
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return array
     */
    public function getRole()
    {
        return $this->role;
    }

    public function subirFoto()
    {
        if (null === $this->foto) {
            return;
        }
        $directorioDestino = __DIR__.'/../../../web/uploads/users/'.$this->usuario.'/';
        $nombreArchivoFoto = uniqid('foto-').'.jpg';
        $this->foto->move($directorioDestino, $nombreArchivoFoto);
        $this->setRutafoto($nombreArchivoFoto);
    }

    /**
     * @param UploadedFile $foto
     */
    public function setFoto(UploadedFile $foto = null)
    {
        $this->foto = $foto;
    }


    /**
     * @return UploadedFile
     */
    public function getfoto()
    {
        return $this->foto;
    }

    /**
     * @return string
     */
    public function getRutafoto()
    {
        return $this->rutafoto;
    }

    /**
     * @param string $rutafoto
     */
    public function setRutafoto($rutafoto)
    {
        $this->rutafoto = $rutafoto;
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
            $this->usuario,
            $this->salt,
            $this->password,
            $this->role,
            $this->rutafoto,
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
            $this->name,
            $this->salt,
            $this->password,
            $this->role,
            $this->rutafoto,
            ) = unserialize($serialized);
    }

    function __toString()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->salt = md5(time());
        $this->modelos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->modelos101B = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add modelos101B
     *
     * @param \AppBundle\Entity\Modelo101B $modelos101B
     *
     * @return Usuario
     */
    public function addModelos101B(\AppBundle\Entity\Modelo101B $modelos101B)
    {
        $this->modelos101B[] = $modelos101B;

        return $this;
    }

    /**
     * Remove modelos101B
     *
     * @param \AppBundle\Entity\Modelo101B $modelos101B
     */
    public function removeModelos101B(\AppBundle\Entity\Modelo101B $modelos101B)
    {
        $this->modelos101B->removeElement($modelos101B);
    }

    /**
     * Get modelos101B
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getModelos101B()
    {
        return $this->modelos101B;
    }
}
